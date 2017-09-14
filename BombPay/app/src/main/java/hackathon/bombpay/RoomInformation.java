package hackathon.bombpay;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by kimjaewoo on 2016. 11. 19..
 */
public class RoomInformation {

    private static RoomInformation instance;

    static JSONObject json;

    public static RoomInformation getInstance(String roomInformation){

        try {
            json = new JSONObject(roomInformation);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        if(instance == null){
            instance = new RoomInformation();
            return instance;
        }
        return instance;
    }

    public String getRoomName() throws JSONException { return json.getString("roomName");}
    public String getRoomPrice() throws JSONException { return json.getString("roomPrice");}
    public String getRoomMax() throws JSONException { return json.getString("roomPeople");}
    public String getRoomRatio() throws JSONException { return json.getString("roomRatio");}
    public String getRoomType() throws JSONException { return json.getString("roomType");}

}
