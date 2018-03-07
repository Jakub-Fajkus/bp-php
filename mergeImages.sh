#!/usr/bin/env bash
FILENAME='graphs_merged.png'

rm ${FILENAME}

convert `find -name "*.png"` -append ${FILENAME}
