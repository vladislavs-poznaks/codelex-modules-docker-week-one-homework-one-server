# Codelex modules - Docker

### Week 1, homework 1, BONUS - SERVER

Building image & running container from root directory

``docker build -t <IMAGE-NAME>:<IMAGE-TAG> .``

``docker run -p 80:80 --name <CONTAINER-NAME> <IMAGE-NAME>:<IMAGE-TAG>``

Alternatively can be pulled & run from dockerhub repo

``docker run -p 80:80 --name <CONTAINER-NAME> vladislavspoznaks/docker-week-one-homework-one-server:homework``