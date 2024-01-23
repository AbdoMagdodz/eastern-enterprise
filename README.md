## Running the project Locally

- clone the project.

- copy `.env.example` to `.env` in the same directory.

- run `docker-compose up --build -d` in order to build the docker image.

- run `docker-compose up migrate-seed` in order to migrate the tables & db seeders.
- run `docker-compose up storage` in order to make the symlink between public and storage.


## Test cases
- run `docker-compose up tests` to run the project test cases.

## Migrations & Seeders
- run `docker-compose up migrate-seed` to run your migrations and seeders.

## Notes:
- if you would like to enter the php container to run some other artisan commands, run `docker exec -it ee-php bash`.

## Screenshots
<hr>

![Login New User](https://i.ibb.co/wB1qSCW/Screenshot-2024-01-17-at-2-15-54-PM-3.png)

![Register New User](https://i.ibb.co/fdZ1pLQ/Screenshot-2024-01-17-at-2-24-13-PM.png)

![Create New Company](https://imgbbupload.com/i/H0L.png)

![Listing Companies](https://i.ibb.co/tm7XqHL/Screenshot-2024-01-17-at-2-17-04-PM-3.png)

![Listing Companies for Guest](https://i.ibb.co/3WVMN80/Screenshot-2024-01-17-at-2-17-26-PM-3.png)

![Showing Company Stock price details](https://imgbbupload.com/i/tLm.png)

![Showing Company Stock price details in case request rate has been exceeded](https://imgbbupload.com/i/hZG.png)







