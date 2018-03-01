#!/usr/bin/env bash
c=1; while [ $c -le 50 ]; do php src/Run/run.php; ((c++)); done
