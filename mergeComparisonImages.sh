#!/usr/bin/env bash
FILENAME='graphs_merged.png'

rm -f ${FILENAME}

convert `ls fitnessHistogram*.png | sort` -append ${FILENAME}
