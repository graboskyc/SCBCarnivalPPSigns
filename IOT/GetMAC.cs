// from http://embedded101.com/BruceEitman/entryid/676/Windows-10-IoT-Core-Getting-the-MAC-Address-from-Raspberry-Pi
// thanks Bruce Eitman!
 private async Task<String> GetMAC() 
{ 
    String MAC = null; 
    StreamReader SR = await GetJsonStreamData("http://localhost:8080/api/networking/ipconfig"); 
    JsonObject ResultData = null; 
    try 
    { 
        String JSONData;
        JSONData = SR.ReadToEnd();
        ResultData = (JsonObject)JsonObject.Parse(JSONData); 
        JsonArray Adapters = ResultData.GetNamedArray("Adapters");
        //foreach (JsonObject Adapter in Adapters) 
        for (uint index = 0; index < Adapters.Count; index++) 
        { 
            JsonObject Adapter = Adapters.GetObjectAt(index).GetObject(); 
            String Type = Adapter.GetNamedString("Type"); 
            if (Type.ToLower().CompareTo("ethernet") == 0) 
            { 
                MAC = ((JsonObject)Adapter).GetNamedString("HardwareAddress"); 
                break; 
            } 
        } 
    } 
    catch (Exception E) 
    { 
        System.Diagnostics.Debug.WriteLine(E.Message); 
    }
    return MAC; 
}
private async Task<StreamReader> GetJsonStreamData(String URL) 
{ 
    HttpWebRequest wrGETURL = null; 
    Stream objStream = null; 
    StreamReader objReader = null;
    try 
    { 
        wrGETURL = (HttpWebRequest)WebRequest.Create(URL); 
        wrGETURL.Credentials = new NetworkCredential("Administrator", "p@ssw0rd"); 
        HttpWebResponse Response = (HttpWebResponse)(await wrGETURL.GetResponseAsync()); 
        if (Response.StatusCode == HttpStatusCode.OK) 
        { 
            objStream = Response.GetResponseStream(); 
            objReader = new StreamReader(objStream); 
        } 
    } 
    catch (Exception e) 
    { 
        System.Diagnostics.Debug.WriteLine("GetData " + e.Message); 
    } 
    return objReader; 
}