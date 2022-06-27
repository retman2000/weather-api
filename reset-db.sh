#!/bin/bash

cp docker/mysql/schema.sql .
rm -rf docker/mysql
mkdir docker/mysql
mv schema.sql docker/mysql/