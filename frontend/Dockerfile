FROM node:14 AS builder

WORKDIR /app

COPY package.json .
COPY package-lock.json .

RUN npm install -g npm@7.22.0
RUN npm install

COPY . .

RUN npm run build


FROM nginx:alpine AS production

COPY --from=builder /app/build /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf