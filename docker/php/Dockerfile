FROM php:7.2-fpm

ARG USER_ID
ARG GROUP_ID

USER root
RUN echo USER_ID
RUN echo GROUP_ID

RUN if getent passwd alma; then userdel -f alma; fi &&\
        if getent group alma; then groupdel alma; fi &&\
        groupadd -g ${GROUP_ID} alma &&\
        useradd -l -u ${USER_ID} -g alma alma &&\
        install -d -m 0755 -o alma alma /home/alma
USER alma