#!/usr/bin/env bash
FILENAME='runFitnessGraphsMerged.png'

rm ${FILENAME}

convert `find -name "runFitnessGraph.png"` -append ${FILENAME}
