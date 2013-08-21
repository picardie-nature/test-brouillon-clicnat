# principales options
NOMDB=clicnat_dev
DROPDB=0

# configuration
CPP=gcc -P -E -x c -I$(shell pwd)
POSTGRE_DIR=$(shell pg_config --sharedir)
POSTGIS_DIR=$(shell find $(POSTGRE_DIR)/contrib -type d -name "postgis-*")
POSTGIS_VER=$(shell basename $(POSTGIS_DIR)|cut -d '-' -f 2)
POSTGIS_VER_MAJ=$(shell echo $(POSTGIS_VER)|cut -d '.' -f 1)
DEFS_POSTGIS=-DPOSTGIS_DIR=$(POSTGIS_DIR) -DPOSTGIS_VER=$(POSTGIS_VER) -DPOSTGRE_DIR=$(POSTGRE_DIR) -DPOSTGIS_VER_MAJ=$(POSTGIS_VER_MAJ)
DEFS_HOST=-DHOSTNAME=$(shell hostname) -DDATE="$(shell date)"
DEFS_DB=-DNOMDB=$(NOMDB) -DDROPDB=$(DROPDB)

install.sql: install_creation_base.sql	
	$(CPP) -o $@ $? $(DEFS_POSTGIS) $(DEFS_HOST) $(DEFS_DB)

install: install.sql
	psql postgres -f install.sql

clean:
	rm install.sql
