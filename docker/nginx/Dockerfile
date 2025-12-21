# Dockerfile para Nginx
FROM nginx:alpine

# Instalar pacotes necessários
RUN apk add --no-cache git gcc libc-dev make openssl-dev pcre-dev libxml2-dev curl

# Copiar configuração do nginx.conf (incluindo a configuração de reqtimeout)
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

CMD ["nginx", "-g", "daemon off;"]