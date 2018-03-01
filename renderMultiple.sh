#!/usr/bin/env bash

BESTS=()


rm bestIndividuals.txt

for d in `ls` ; do
    echo $d
    cd $d
    #get the best individual fitness
    BESTS+=(`tail best.txt -n 1`)
#    `../../../render.sh`
    cd ..
done


for item in ${BESTS[*]}
do
    printf "%s\n" $item >> bestIndividuals.txt
done

#sort best individuals
sort bestIndividuals.txt > bestIndividualsSorted.txt

#average of the best fitnesses
awk '{ total += $1 } END { print total/NR }' bestIndividuals.txt > avg.txt
