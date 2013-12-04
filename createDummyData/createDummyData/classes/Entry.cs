using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace createDummyData.classes
{
    class Entry
    {
       //fields

        //properties
        public DateTime DateTime { get; set; }
        public double Temperature { get; set; }
        public double Windspeed { get; set; }

        //ctor
        public Entry() : this(DateTime.MinValue,0.0,0.0){}
        public Entry(DateTime dateTime, double temp, double wind)
        {
            this.DateTime = dateTime;
            this.Temperature = temp;
            this.Windspeed = wind;
        }

        //other methods

        public override string ToString()
        {
            return "DateTime: " + this.DateTime + "\n" +
                "Temperature: " + this.Temperature + "\n" +
                "Windspeed: " + this.Windspeed + "\n";
        }
    }
}
