using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.Common;
using MySql.Data.MySqlClient;
using MySql.Data;
using System.Data;
using System.Data.Common;
using System.Configuration;


namespace createDummyData.classes
{
    class DAL
    {
         //fields
        private DbConnection conn;
        private string connStr;
        

        //properties
        public int affectedRows { get; set; }

        //ctor
        public DAL()
        {
            this.connStr = ConfigurationManager.AppSettings["connStr"];
            this.conn = new MySqlConnection(connStr);
            this.affectedRows = 0;
        }

        //other methods
        public void OpenConnection()
        {
            this.conn.Open();
        }
        public void CloseConnection()
        {
            if ((this.conn != null)&&(this.conn.State == ConnectionState.Open))
            {
                this.conn.Close();
            }
        }


        public IDbCommand cmdInsert(DateTime dateTime, double temp, double wind)
        {
            IDbCommand cmdInsert = this.conn.CreateCommand();
            cmdInsert.CommandText = string.Format("INSERT INTO tbl_values (id, dateTime, temperature, windSpeed) VALUES(@id, @dateTime, @temperature, @windSpeed)");

            IDbDataParameter paraId = cmdInsert.CreateParameter();
            paraId.DbType = DbType.Int32;
            paraId.ParameterName = "@id";
            paraId.Value = null;
            cmdInsert.Parameters.Add(paraId);

            IDbDataParameter paraDateTime = cmdInsert.CreateParameter();
            paraDateTime.DbType = DbType.DateTime;
            paraDateTime.ParameterName = "@dateTime";
            paraDateTime.Value = dateTime;
            cmdInsert.Parameters.Add(paraDateTime);

            IDbDataParameter paraTemp = cmdInsert.CreateParameter();
            paraTemp.DbType = DbType.Double;
            paraTemp.ParameterName = "@temperature";
            paraTemp.Value = temp;
            cmdInsert.Parameters.Add(paraTemp);

            IDbDataParameter paraWind = cmdInsert.CreateParameter();
            paraWind.DbType = DbType.Double;
            paraWind.ParameterName = "@windSpeed";
            paraWind.Value = wind;
            cmdInsert.Parameters.Add(paraWind);

            this.affectedRows = cmdInsert.ExecuteNonQuery();

            return cmdInsert;
        }
    }
}
