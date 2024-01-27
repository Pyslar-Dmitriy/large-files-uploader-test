## Instalation:
Docker is required to run application.
```
git clone git@github.com:Pyslar-Dmitriy/large-files-uploader-test.git
```
```
cd large-files-uploader-test
```
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
```
composer update
```
```
sail up -d
```
Then You need to manually rename `.env.example` to `.env`
```
sail artisan key:generate
```
```
sail root-shell
```
```
npm install
```
```
npm run build
```
## Then go to homepage:
http://localhost/

## All uploaded files will be in `storage/app/files` directory
