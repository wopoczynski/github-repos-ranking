FROM nginx:alpine
RUN apk update && apk add bash openssl
RUN mkdir -p /etc/nginx/ssl
RUN chmod -R 600 /etc/nginx/ssl
RUN openssl req -batch -subj '/CN=localhost' -x509 -newkey rsa:4096 -nodes -keyout /etc/nginx/ssl/key.pem -out /etc/nginx/ssl/key.pem -days 365
