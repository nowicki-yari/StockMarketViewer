from flask import Flask, request
from flask_restful import Resource, Api
from StockInfo import StockInfo
from StockHistoricData import StockHistoricData
app = Flask(__name__)
api = Api(app)

api.add_resource(StockInfo, '/stock/<string:stock>/info')
api.add_resource(StockHistoricData, '/stock/<string:stock>/history/<string:start_date>/<string:end_date>')

if __name__ == '__main__':
    app.run()
