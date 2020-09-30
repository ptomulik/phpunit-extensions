#!/bin/bash

set -e

here="`dirname $0`";

top="$here/..";
abstop="`readlink -f $top`";

pushd $top > /dev/null

for t_php in `find docs/sphinx/examples -name "*Test.php"`; do
    t_stdout=`echo $t_php|sed -e 's/\.php$/.stdout/'`
    t_stderr=`echo $t_php|sed -e 's/\.php$/.stderr/'`

    vendor/bin/phpunit -c docs/sphinx/examples/phpunit.xml $t_php | sed -e "s:^$abstop/::" | tee "$t_stdout";
done

popd > /dev/null
