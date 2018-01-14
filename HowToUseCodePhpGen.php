@php

@class -tag author -a -e BaseUser -i interface1,interFace2 User
@const -q HASH abcdef123457
@property -v protected -t string -get -set name
@function -p {User:objUser = null} -r object initWithUser
@method -s -r User -p {User:objUser = null} initWithUser

@ec

@interface -e interface interface1
@ei



@endPhp