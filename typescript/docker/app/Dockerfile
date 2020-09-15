FROM node:14.10.1-alpine3.12

USER node

WORKDIR /home/node

COPY app/package*.json ./

RUN npm ci

