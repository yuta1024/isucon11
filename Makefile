.PHONY: install

install:
	sudo cp -R etc /
	sudo -u isucon cp -R sql /home/isucon/webapp/
	sudo -u isucon cp -R php /home/isucon/webapp/
	sudo -u isucon cp -R myphp /home/isucon/webapp/
	sudo -u isucon cp local/php/etc/conf.d/xdenug.ini /home/isucon/local/php/etc/conf.d/xdebug.ini
	sudo systemctl restart nginx isucondition.php
