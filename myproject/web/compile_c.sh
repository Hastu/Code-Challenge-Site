#! /bin/bash

gcc $1 -o code
chmod 777 code
./code < $2
rm code
