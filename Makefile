.PHONY: install

install:
	sudo cp -R etc /
	sudo -u isucon cp -R sql /home/isucon/webapp/
	sudo -u isucon cp -R php /home/isucon/webapp/
