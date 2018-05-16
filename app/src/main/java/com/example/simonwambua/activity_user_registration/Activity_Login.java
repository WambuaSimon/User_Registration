package com.example.simonwambua.activity_user_registration;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Activity_Login extends AppCompatActivity {
    EditText email, password;
    TextView link_signup;
    Button login;

    String URL = "http:// 192.168.43.41/user_registration/index.php";
    JSONParser jsonParser = new JSONParser();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle("User Login");

        email = (EditText) findViewById(R.id.email);
        password = (EditText) findViewById(R.id.password);
        link_signup = (TextView) findViewById(R.id.link_signup);
        link_signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getApplicationContext(), Activity_Register.class));
            }
        });
        login = (Button) findViewById(R.id.login);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Login_User attemptLogin = new Login_User();
                attemptLogin.execute(email.getText().toString(), password.getText().toString(), "");
                startActivity(new Intent(getApplicationContext(),Activity_User_Images.class));
            }
        });
    }

    private class Login_User extends AsyncTask<String, String, JSONObject> {

        @Override

        protected void onPreExecute() {

            super.onPreExecute();

        }

        @Override

        protected JSONObject doInBackground(String... args) {
            String password = args[5];
            String Dob = args[4];
            String Languages = args[3];
            String Gender = args[2];
            String Email = args[1];
            String First_name = args[0];

            ArrayList params = new ArrayList();
            params.add(new BasicNameValuePair("First_name", First_name));
            params.add(new BasicNameValuePair("Email", Email));
            params.add(new BasicNameValuePair("Gender", Gender));
            params.add(new BasicNameValuePair("Languages", Languages));
            params.add(new BasicNameValuePair("Dob", Dob));
            params.add(new BasicNameValuePair("password", password));
            if (email.length() > 0)
                params.add(new BasicNameValuePair("Email", Email));

            JSONObject json = jsonParser.makeHttpRequest(URL, "POST", params);


            return json;

        }

        protected void onPostExecute(JSONObject result) {

            // dismiss the dialog once product deleted
            //Toast.makeText(getApplicationContext(),result,Toast.LENGTH_LONG).show();

            try {
                if (result != null) {
                    Toast.makeText(getApplicationContext(), result.getString("message"), Toast.LENGTH_LONG).show();
                } else {
                    Toast.makeText(getApplicationContext(), "Unable to retrieve any data from server", Toast.LENGTH_LONG).show();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

    }
}
