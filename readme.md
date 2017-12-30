# FMQAI

## Background
2009 Interview practical. Goal was to create a PDF content search engine that is 508 compliant.

## Features
 - 508 compliant
 - Type ahead search term completion
 - 

## Goal
N/A

## Requirements
 - Docker
 - Command prompt of some sort
 
## Road map
None; this project repository is for historic reference only.

## Usage
Clone the repository locally:
```
cd /project/root/parent
git clone https://github.com/davidjeddy/fmqai.git
cd ./fmqai
```

Then build and start the image via:

```
docker build -t fmqai . --rm
docker run -d -h localhost -p 80:80 --name fmqai -v "$PWD":/var/www/html fmqai:latest --rm
docker logs -f fmqai
```

Now lets create abd load the database schema
```
docker exec -i fmqai_db_1 mysql -uroot -proot -dfmqai < ./docker/mysql/database.sql
```

Finally, if all went well, you should be able to visit `localhost` in your client browser of choice and see the 
application running.


## Warning
This project was pre-framework or best practice abeyance. It was a time sensitive example of competence at the time.

Though recently wrapped in a docker container for portability and hosted in a GiT repo; neither of which existed when
the site was made, this site IS NOT:
 - Secure
 - Pragmatic
 - Best practice adhering
 - An example of any sort of decent practices; if anything this is what you should NOT be doing
