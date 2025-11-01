FROM nginx:stable

# Create the web root (not strictly required but clean)
RUN mkdir -p /var/www/html

WORKDIR /var/www/html

# Copy custom nginx config into container
COPY default.conf /etc/nginx/conf.d/default.conf

# Expose port 80
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]

# Note: We do NOT install PHP inside Nginx. PHP-FPM runs in separate container php and Nginx forwards to php:9000.

