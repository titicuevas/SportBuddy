#!/bin/bash

echo -e ":lang: es\n:toc:\n:title-page:\n:chapter-label:\n:toc-title: Tabla de contenidos\n:sectnums:\n\n" | cat - pro.adoc > propuesta.adoc

S[1]='\[cols=">,<",options="header",\]'
S[2]='\[width="100%",cols=">43%,<57%",options="header",\]'
S[3]='\[width="51%".*'
R='\[width="100%",cols=">20%,<80%",options="header",\]/'

for p in ${S[*]}
do
    sed -i s/^$p$/$R propuesta.adoc
done

sed -i 's/^\[width="[2-9].*$/\[cols="<3%,^,^,^,^",options="header",\]/' propuesta.adoc
