#!/usr/bin/env bash
for d in `ls | grep 2018` ; do
    echo $d
    cd $d
    #get the best individual fitness
    BESTS+=(`tail best.txt -n 1`)
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
