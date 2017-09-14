package hackathon.bombpay;


import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.WebView;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;


/**
 * A simple {@link Fragment} subclass.
 */
public class QRCode extends android.app.DialogFragment {

    public View view;

    public Button startButton;

    int currentQRCode;

    String roomName;
    String roomPrice;
    public String roomMax;
    String roomType;

    public QRCode() {
        // Required empty public constructor
    }

    void getCurrentQRCode(int temp_currentQRCode){
        currentQRCode = temp_currentQRCode;
    }

    void getRoomInformation(String temp_roomName, String temp_roomPrice, String temp_roomMax, String temp_roomType) {
        roomName = temp_roomName;
        roomPrice = temp_roomPrice;
        roomMax = temp_roomMax;
        roomType = temp_roomType;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        view = inflater.inflate(R.layout.fragment_qrcode, container, false);

        TextView textViewRoomTitle = (TextView) view.findViewById(R.id.roomTitle);
        TextView textViewRoomPrice = (TextView) view.findViewById(R.id.roomPrice);
        TextView textViewRoomPeople = (TextView) view.findViewById(R.id.roomPeople);
        TextView textViewRoomType = (TextView) view.findViewById(R.id.roomType);

        textViewRoomTitle.setText("가게 이름 : "+roomName);
        textViewRoomPrice.setText("  총 가격 : "+roomPrice);
        textViewRoomPeople.setText("현재 인원 : 1 / "+roomMax);
        textViewRoomType.setText("게임 종류 : "+roomType);

        ImageView imageViewRoomQRCode = (ImageView) view.findViewById(R.id.roomQRcode);

        if(currentQRCode==1) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_one);
        if(currentQRCode==2) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_two);
        if(currentQRCode==3) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_three);
        if(currentQRCode==4) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_four);
        if(currentQRCode==5) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_five);
        if(currentQRCode==6) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_six);
        if(currentQRCode==7) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_seven);
        if(currentQRCode==8) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_eight);
        if(currentQRCode==9) imageViewRoomQRCode.setImageResource(R.drawable.qrcodeimg_nine);

        startButton = (Button) view.findViewById(R.id.startButton);
        startButton.setEnabled(false);

        startButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                MainActivity mainActivity = (MainActivity) getActivity();
                WebView webView = mainActivity.myWebView;

                webView.loadUrl("javascript:startGame()");

            }
        });

        return view;
    }

}
