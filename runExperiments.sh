#!/usr/bin/env bash
c=1; while [ $c -le $1 ]; do php src/Run/run.php $2; ((c++)); done
