#!/usr/bin/env bash
FILENAME='runFitnessGraphsMerged.png'

rm -f ${FILENAME}

convert `find -name "runFitnessGraph.png"` -append ${FILENAME}
