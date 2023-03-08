# Test-Junior Programmer

## Running This Project

Import ADM1 geojson data using ogr2ogr
```
ogr2ogr -f "PostgreSQL" PG:"host=<hostname> user=<username> dbname=<database> password=<password>" <input_file.geojson> -nln provinces -nlt PROMOTE_TO_MULTI -overwrite
```

Import ADM2 geojson data using ogr2ogr
```
ogr2ogr -f "PostgreSQL" PG:"host=<hostname> user=<username> dbname=<database> password=<password>" <input_file.geojson> -nln cities -nlt PROMOTE_TO_MULTI -overwrite
```

database migration and seeding
```
php artisan migrate --seed
```

run server
```
php artisan serve
```