all: clean_db tests

clean_db:
	make -C ../sql/ clean install NOMDB=clicnat_test DROPDB=1

tests:
	phpunit --colors --configuration tests.xml
