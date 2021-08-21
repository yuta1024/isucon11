<?php


$dbh = new PDO('mysql:dbname=isucondition;host=localhost', 'isucon', 'isucon')

/*
$dropProbability = 0.9;

if ((rand() / getrandmax()) <= $dropProbability) {
	header('HTTP/1.1 202 Accepted');
	exit();
}
*/

$jiaIsuUuid = substr($_SERVER['REQUEST_URI'], strlen('/api/condition/'), 36);

if ($jiaIsuUuid === '') {
    $response->getBody()->write('missing: jia_isu_uuid');

    return $response->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST)
        ->withHeader('Content-Type', 'text/plain; charset=UTF-8');
}


$req = json_decode(file_get_contents('php://input'));
if ($req === null ){
    $response->getBody()->write('bad request body');
}

if (count($req) === 0) {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: text/plain; charset=UTF-8');
    echo('bad request body');
    exit();
}

foreach ($req as $cond) {
    if (!isValidConditionFormat($cond->condition)) {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: text/plain; charset=UTF-8');
        echo('bad request body');
        exit();
    }
}

$dbh->beginTransaction();

try {
    $stmt = $this->dbh->prepare('SELECT COUNT(*) FROM `isu` WHERE `jia_isu_uuid` = ?');
    $stmt->execute([$jiaIsuUuid]);
    $count = $stmt->fetch()[0];
} catch (PDOException $e) {
    $dbh->rollBack();

    return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
}

if ($count == 0) {
    $dbh->rollBack();
    $response->getBody()->write('not found: isu');

    return $response->withStatus(StatusCodeInterface::STATUS_NOT_FOUND)
        ->withHeader('Content-Type', 'text/plain; charset=UTF-8');
}

foreach ($req as $cond) {
    try {
        $stmt = $dbh->prepare(
            'INSERT INTO `isu_condition`' .
            '	(`jia_isu_uuid`, `timestamp`, `is_sitting`, `is_dirty`, `is_overweight`, `is_broken`, `message`)' .
            '	VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $jiaIsuUuid,
            date('Y-m-d H:i:s', $cond->timestamp),
            (int)$cond->isSitting,
            strpos($cond->condition, 'is_dirty=true') === false ? 0 : 1,
            strpos($cond->condition, 'is_overweight=true') === false ? 0 : 1,
            strpos($cond->condition, 'is_broken=true') === false ? 0 : 1,
            $cond->message,
        ]);
    } catch (PDOException $e) {
        $dbh->rollBack();

        return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
    }
}

$dbh->commit();

header('HTTP/1.1 202 Accepted');
