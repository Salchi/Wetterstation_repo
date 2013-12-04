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

using createDummyData.classes;

namespace createDummyData
{
    class Program
    {
        static void Main(string[] args)
        {
            DAL DAL = new DAL();
            Entry entry = new Entry();
            List<Entry> entries = new List<Entry>();
            Random randomDouble = new Random();
            long Ticks = DateTime.UtcNow.Ticks - 315376200000000;
            Console.WriteLine(new DateTime(Ticks));
            for (int i = 0; i < 70080; i++) //dummy data für 2 Jahre
            {
                entries.Add(new Entry(new DateTime(Ticks),(randomDouble.Next(-20,30)+randomDouble.NextDouble()),(randomDouble.Next(0,70)+randomDouble.NextDouble())));
                Ticks += 9000000000;
            }
            Console.WriteLine(entries[entries.Count - 2].ToString());
            Console.WriteLine(entries[entries.Count-1].ToString());
            
            
             try
            {
                DAL.OpenConnection();

                foreach (Entry e in entries)
                {
                    DAL.cmdInsert(e.DateTime,e.Temperature, e.Windspeed);
                }

                
                Console.WriteLine("Daten erfolgreich eingetragen!!");
            }
            catch (Exception ex)
            {
                //Console.Write(ex.Message);
                throw;
            }
            finally
            {
                DAL.CloseConnection();
            }
            
            Console.ReadKey();
        }
    }
}
