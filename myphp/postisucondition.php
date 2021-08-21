<?php


function isValidConditionFormat(string $conditionStr): bool
{
    $keys = ["is_dirty=", "is_overweight=", "is_broken="];

    $VALUE_TRUE = 'true';
    $VALUE_FALSE = 'false';

    $idxCondStr = 0;

    foreach ($keys as $idxKeys => $key) {
        if (!str_starts_with(mb_substr($conditionStr, $idxCondStr), $key)) {
            return false;
        }
        $idxCondStr += mb_strlen($key);

        if (str_starts_with(mb_substr($conditionStr, $idxCondStr), $VALUE_TRUE)) {
            $idxCondStr += mb_strlen($VALUE_TRUE);
        } elseif (str_starts_with(mb_substr($conditionStr, $idxCondStr), $VALUE_FALSE)) {
            $idxCondStr += mb_strlen($VALUE_FALSE);
        } else {
            return false;
        }

        if ($idxKeys < (count($keys) - 1)) {
            if ($conditionStr[$idxCondStr] !== ',') {
                return false;
            }
            $idxCondStr++;
        }
    }

    return $idxCondStr == mb_strlen($conditionStr);
}

$dbh = new PDO('mysql:dbname=isucondition;host=192.168.0.12', 'isucon', 'isucon');

/*
$dropProbability = 0.9;

if ((rand() / getrandmax()) <= $dropProbability) {
	header('HTTP/1.1 202 Accepted');
	exit();
}
*/

$jiaIsuUuid = substr($_SERVER['REQUEST_URI'], strlen('/api/condition/'), 36);

if ($jiaIsuUuid === '') {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: text/plain; charset=UTF-8');
    echo('missing: jia_isu_uuid');
    exit();
}


$req = json_decode(file_get_contents('php://input'), 1);
if ($req === null ){
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: text/plain; charset=UTF-8');
    echo('bad request body');
    exit();
}

if (count($req) === 0) {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: text/plain; charset=UTF-8');
    echo('bad request body');
    exit();
}

foreach ($req as $cond) {
    if (!isValidConditionFormat($cond['condition'])) {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: text/plain; charset=UTF-8');
        echo('bad request body');
        exit();
    }
}

$dbh->beginTransaction();

try {
    $stmt = $dbh->prepare('SELECT COUNT(*) FROM `isu` WHERE `jia_isu_uuid` = ?');
    $stmt->execute([$jiaIsuUuid]);
    $count = $stmt->fetch()[0];
} catch (PDOException $e) {
    $dbh->rollBack();

    header('HTTP/1.1 500 Internal Server Error');
    exit();
}

if ($count == 0) {
    $dbh->rollBack();
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: text/plain; charset=UTF-8');
    echo('not found: isu');
    exit();
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
            date('Y-m-d H:i:s', $cond['timestamp']),
            (int)$cond['is_sitting'],
            strpos($cond['condition'], 'is_dirty=true') === false ? 0 : 1,
            strpos($cond['condition'], 'is_overweight=true') === false ? 0 : 1,
            strpos($cond['condition'], 'is_broken=true') === false ? 0 : 1,
            $cond['message'],
        ]);
    } catch (PDOException $e) {
        $dbh->rollBack();

        header('HTTP/1.1 500 Internal Server Error');
        exit();
    }
}

$dbh->commit();

header('HTTP/1.1 202 Accepted');
