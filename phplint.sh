#!/bin/bash

clear ;

PHPCS_STANDARD="EPCS"

for x in $(ls -1 *.class.php)
do
	phpcs --standard=$PHPCS_STANDARD $x
done

