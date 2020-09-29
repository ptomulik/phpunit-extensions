ARG FOX_IMG
FROM ${FOX_IMG}
MAINTAINER Paweł Tomulik <ptomulik@meil.pw.edu.pl>

ARG FOX_USER='php-fox'
ARG FOX_GROUP='php-fox'
ARG FOX_UID=6789
ARG FOX_GID=6789
ARG FOX_HOME=/home/${FOX_USER}
ARG FOX_CODE=/code
ARG FOX_DOTENV_FILE=.env.docker
ARG FOX_BEHAT_PARAMS=''
ARG SAMI_SOURCE_DIR='packages/*'

ENV FOX_USER=$FOX_USER \
    FOX_GROUP=$FOX_GROUP \
    FOX_UID=$FOX_UID \
    FOX_GID=$FOX_GID \
    FOX_HOME=$FOX_HOME \
    FOX_CODE=$FOX_CODE \
    FOX_DOTENV_FILE=$FOX_DOTENV_FILE \
    BEHAT_PARAMS=$FOX_BEHAT_PARAMS \
    SAMI_SOURCE_DIR=$SAMI_SOURCE_DIR

RUN if [ -f /etc/alpine-release ]; then \
      addgroup -g $FOX_GID $FOX_GROUP && \
      adduser -h $FOX_HOME -G $FOX_GROUP -u $FOX_UID -D $FOX_USER; \
    else \
      groupadd -g $FOX_GID $FOX_GROUP && \
      useradd -m -d $FOX_HOME -g $FOX_GROUP --uid $FOX_UID $FOX_USER; \
    fi; \
    mkdir -p $FOX_CODE && chown $FOX_USER:$FOX_GROUP $FOX_CODE

VOLUME $FOX_CODE

WORKDIR $FOX_CODE

# vim: set ft=dockerfile:
