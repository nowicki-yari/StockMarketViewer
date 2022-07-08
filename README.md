# StockMarketViewer
## Project overview
This project its main goal is to view the stock market. This includes:
- Stock exchanges
  - Basic info (localtime, location)
  - Indexes
- Individual stocks
  - Basic info
  - Real time graph

User will be able to create an account. With this account they will be able to select their 'favorite' shares.

## Services
1. Yahoo Finance API (Python)

   This API will be used to receive the latest stock data. This will either be a direct external service or it will first go through a data processing pipeline.
2. Localtime API (Language to be determined, most likely SOAP C#)

   This API will used to determine the local time of a stock exchange.
3. News/Twitter API (Python)

   This API will be used to receive the latest news about a certain topic/stock.


## Other info
- Deployment will be on heroku.
- The project will be dockerrized.
- Swagger.io will be used for documentation.
