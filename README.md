# PHP 8.1 + Symfony 5.4 + RabbitMQ (all with Docker)


# Documentation
## Use cases
### Clients
#### Admin can create a client
When a client enters the company, an administrator needs to register him.
The following information is required:
- Company name
- CNPJ
- Email

An email will send and a main User is create for this client.
This user will have a client role. 
You may need some other information, for example, contact numbers, etc.