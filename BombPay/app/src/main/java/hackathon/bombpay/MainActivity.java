package hackathon.bombpay;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.webkit.JavascriptInterface;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.LinearLayout;
import android.widget.TextView;

import org.json.JSONException;

public class MainActivity extends AppCompatActivity {

    public int currentQRCode = 1;
    public WebView myWebView;
    private final Handler handler = new Handler();
    Boolean roomMake = false;

    public class AndroidBridge{

        QRCode QRCode = new QRCode();

        @JavascriptInterface
        public void notifyPeople(final String peopleNum){
            handler.post(new Runnable() {
                @Override
                public void run() {

                    if(roomMake){
                        TextView test = (TextView) QRCode.view.findViewById(R.id.roomPeople);
                        test.setText("현재 인원 : "+peopleNum+" / "+QRCode.roomMax);

                        if (Integer.parseInt(peopleNum)==Integer.parseInt(QRCode.roomMax)){
                            QRCode.startButton.setEnabled(true);
                        }
                    }

                }
            });
        }

        @JavascriptInterface
        public void finishGame(){
            handler.post(new Runnable() {
                @Override
                public void run() {

                    if(roomMake){

                        QRCode.dismiss();

                    }

                }
            });
        }

        @JavascriptInterface
        public void joinRoom(){
            handler.post(new Runnable() {
                @Override
                public void run() {
                    Intent intent = new Intent("com.google.zxing.client.android.SCAN");
                    intent.putExtra("SCAN_MODE", "ALL");
                    startActivityForResult(intent, 0);
                }
            });
        }

        @JavascriptInterface
        public void startGame(){
            handler.post(new Runnable() {
                @Override
                public void run() {
                    myWebView.loadUrl("javascript:startGame()");
                }
            });
        }

        @JavascriptInterface
        public void confirmRoom(final String roomInformationText){
            handler.post(new Runnable() {
                @Override
                public void run() {

                    Log.i(roomInformationText,"JSON input from server");

                    RoomInformation roomInformation = RoomInformation.getInstance(roomInformationText);

                    QRCode.getCurrentQRCode(currentQRCode);
                    try {
                        QRCode.getRoomInformation(roomInformation.getRoomName(), roomInformation.getRoomPrice(), roomInformation.getRoomMax(), roomInformation.getRoomType());
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                    QRCode.show(getFragmentManager(),"QRCode");

                    //내가 방장
                    roomMake = true;

                    try {
                        if(currentQRCode==1) myWebView.loadUrl("javascript:connectServer('0iD44','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==2) myWebView.loadUrl("javascript:connectServer('0iD46','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==3) myWebView.loadUrl("javascript:connectServer('0iD48','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==4) myWebView.loadUrl("javascript:connectServer('0iD4k','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==5) myWebView.loadUrl("javascript:connectServer('0iD4l','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==6) myWebView.loadUrl("javascript:connectServer('0iD4n','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==7) myWebView.loadUrl("javascript:connectServer('0iD4o','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==8) myWebView.loadUrl("javascript:connectServer('0iD4q','"+roomInformation.getRoomMax()+"')");
                        if(currentQRCode==9) myWebView.loadUrl("javascript:connectServer('0iD4L','"+roomInformation.getRoomMax()+"')");

                        System.out.println("\n\n--------"+roomInformation.getRoomMax()+"--------\n");
                        //+","+roomInformation.getRoomPrice()+","+roomInformation.getRoomType()+","+roomInformation.getRoomRatio()

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    //qrCodeId : 0iD44 0iD46 0iD48 0iD4k 0iD4l 0iD4n 0iD4o 0iD4q 0iD4L

                    currentQRCode++;

                }
            });
        }

    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);



        myWebView = (WebView) findViewById(R.id.webView);
        myWebView.loadUrl("http://192.168.70.31:7896/bombpay/index.php");

        myWebView.addJavascriptInterface(new AndroidBridge(), "BombPay");

        myWebView.getSettings().setJavaScriptEnabled(true);
        myWebView.getSettings().setDomStorageEnabled(true);

        /*
        myWebView.getSettings().setSupportMultipleWindows(true);

        myWebView.getSettings().setGeolocationEnabled(true);
        myWebView.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
        myWebView.getSettings().setBuiltInZoomControls(true);

        myWebView.setWebViewClient(new WebViewClient());

        myWebView.setWebChromeClient(new WebChromeClient(){

            @Override
            public boolean onCreateWindow(WebView view, boolean dialog, boolean userGesture, android.os.Message resultMsg)
            {
                view.removeAllViews();

                WebView childView = new WebView(view.getContext());
                childView.getSettings().setJavaScriptEnabled(true);
                childView.setWebChromeClient(this);
                childView.setWebViewClient(new WebViewClient());
                childView.setLayoutParams(new LinearLayout.LayoutParams(LinearLayout.LayoutParams.FILL_PARENT, LinearLayout.LayoutParams.FILL_PARENT));

                view.addView(childView);

                WebView.WebViewTransport transport = (WebView.WebViewTransport) resultMsg.obj;
                transport.setWebView(childView);
                resultMsg.sendToTarget();
                return true;
            }
        });

        */

        /*
        myWebView.setWebChromeClient(new WebChromeClient() {
            @Override public boolean onJsAlert(WebView view, String url, String message, JsResult result) {
                return super.onJsAlert(view, url, message, result);
            }
        });
        */

    }

    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        if(requestCode == 0) {

            if(resultCode == Activity.RESULT_OK)
            {
                String contents = data.getStringExtra("SCAN_RESULT");
                //위의 contents 값에 scan result가 들어온다.

                roomMake = false;

                String qrCodeId = contents.substring(24,29);

                Log.i("QR코드 방 id : ",qrCodeId);

                myWebView.loadUrl("javascript:connectServer1('"+qrCodeId+"')");

            }

        }

        super.onActivityResult(requestCode, resultCode, data);
    }

}