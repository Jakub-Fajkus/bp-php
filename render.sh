#!/usr/bin/env bash
cat log.txt   | grep best | cut -d" " -f 6 > best.txt
cat log.txt   | grep aver | cut -d" " -f 3 > avg.txt
#vezme slopec z prvniho, sloupec z druheho a vlozi je do souboru
paste best.txt avg.txt > joined.txt
#vlozeni hlavicky
echo 'Generation  Best fitness    AverageFitness' > generations.txt
#pridani cislovani radku
awk 'NR==1{i=1}{print i " "$0} {i=i+1}' joined.txt  >> generations.txt
gnuplot /home/jakub/PhpstormProjects/bp/gnuplot.txt


#one number for the configuration -
#best fitness
#median fitness
#avg fitness
