# SVEN - Web Assessment - Pet Grooming APP

## Installation

1. Run `npm install` in the root folder to install dependencies.
```bash
npm install
```
2. Create a database in your MySQL server named `db_pet_grooming` for the migrations.

3. Run the installation script and it will automatically install the necessary dependencies for the backend and frontend.
```bash
npm run install:app
```

4. Create a `.env` file in the `./frontend/` directory and paste these 2 lines. However, you need to copy, too, the value of `FRONTEND_SECRET` in `.env` file in the `./backend/` directory.
```text
SECRET_KEY=RI7WU2vAxLe80L6f1e4ovFlmdLVrGuvP
API_URL=http://localhost:8000
```
__Note:__ The `FRONTEND_SECRET` key provides an additional layer of security in the application, helping to prevent unauthorized access and requests from untrusted sources.

5. Lastly, serve the application.
```bash
npm run serve
```





Prepared & Developed by: [Christopher Robin Chase](https://github.com/chrischase011)