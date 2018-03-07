#!/usr/bin/env bash

rm bestIndividuals.txt

for d in `ls | grep 2018` ; do
    echo $d
    cd $d
    `/home/jakub/PhpstormProjects/bp/render.sh`
    cd ..
done
