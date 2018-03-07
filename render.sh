#!/usr/bin/env bash
cat log.txt   | grep best | cut -d" " -f 6 > best.txt
cat log.txt   | grep aver | cut -d" " -f 3 > avg.txt
cat log.txt   | grep median | cut -d" " -f 3 > median.txt
cat log.txt   | grep "fitness in top" | cut -d" " -f6 > avgTop.txt
cat log.txt   | grep "fitness in bottom" | cut -d" " -f6 > avgBottom.txt

#vezme slopec z prvniho, sloupec z druheho a vlozi je do souboru
paste best.txt avg.txt avgTop.txt avgBottom.txt > joined.txt
#vlozeni hlavicky
echo 'Generation  Best fitness    AverageFitness    Average Fitness in top half    Average Fitness in top half' > generations.txt
#pridani cislovani radku
awk 'NR==1{i=1}{print i " "$0} {i=i+1}' joined.txt  >> generations.txt
gnuplot /home/jakub/PhpstormProjects/bp/gnuplotFitnessGraph.txt
