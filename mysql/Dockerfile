FROM mariadb

# setting root password
ENV MYSQL_ROOT_PASSWORD root

# setting user and password
ENV MYSQL_USER=audiogene
ENV MYSQL_PASSWORD=cakephp

# naming the database
ENV MYSQL_DATABASE=audiogene_collection

# initalized database from script
COPY setup.sql /docker-entrypoint-initdb.d/


