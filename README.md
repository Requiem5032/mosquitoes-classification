# Instruction (AI Model)
1. Install all dependencies
   ```
   pip install -r requirements.txt
   ```
2. Run deploy.py to start using the model
   ```
   python deploy.py
   ```

# Instruction (Web App)
1. Docker Engine is required for running the web application. If not, then an installation is compulsory.
2. Clone the project on Github or download zip file then unzip it.
3. Open Docker Engine, then open the terminal on the folder that contains the project. 
    ```
The ports that are used in this project are as below. Make sure no other running applications on the current system uses those.
\begin{itemize}
    \item Web interface: port 80
    \item MySQL database: port 3307
    \item phpMyAdmin: port 8081
\end{itemize}
	```
4. Type “docker-compose up” into the terminal to run the project containers. 
   ```
Database is accessed by the URL “localhost:8081” on the browser. Login information are as follow:
\begin{itemize}
    \item Username: root
    \item Password: 12345
\end{itemize}
   ```
5. For importing the dataase, create a new database on the phpMyAdmin webpage, then select "import" button. Locate the file "mosq\_imagesdb.sql" in the "db\_schema" folder. After that, choose import at the end of the page. If the query returns successfully, then the database is imported and ready to use.
