all: clean_db tests

clean_db:
	make -C ../sql/ clean install NOMDB=clicnat_dev DROPDB=1

tests:
	phpunit --colors .
