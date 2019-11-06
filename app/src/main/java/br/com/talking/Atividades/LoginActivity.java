package br.com.talking.Atividades;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import br.com.talking.R;

public class LoginActivity extends AppCompatActivity {

    String urlWebServicesDesenvolvimento = "http://192.168.0.115/talking/WebServices/getUsuarios.class.php"; //se for publicar colocar no lugar do IP o domínio do site

    StringRequest stringRequest;
    RequestQueue requestQueue;

    private EditText editEmail, editSenha;
    private Button btnEntrar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        requestQueue = Volley.newRequestQueue(this);


        editEmail = (EditText) findViewById(R.id.edit_email);
        editSenha = (EditText) findViewById(R.id.edit_senha);
        btnEntrar = (Button) findViewById(R.id.btn_entrar);


        btnEntrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //enviarFormulario();

                boolean validado = true;

                if(editEmail.getText().length()==0) {
                    editEmail.setError("Campo E-mail Obrigatório");
                    editEmail.requestFocus();
                    validado = false;
                }

                if(editSenha.getText().length()==0) {
                    editSenha.setError("Campo Senha Obrigatório");
                    editSenha.requestFocus();
                    validado = false;
                }

                if (validado) {
                    validarLogin();
                }

            }
        });

    }


    private void validarLogin() {

        stringRequest = new StringRequest(Request.Method.POST,
                urlWebServicesDesenvolvimento,

                new Response.Listener<String>() {

                    @Override
                    public void onResponse(String response) {
                        Log.v("LogLogin", response);

                        try {

                            JSONObject jsonObject = new JSONObject(response);

                            boolean isErro = jsonObject.getBoolean("erro");

                            if(isErro) {

                                Toast.makeText(getApplicationContext(), jsonObject.getString("mensagem"), Toast.LENGTH_LONG).show();

                            }else {

                                Intent main = new Intent(LoginActivity.this, MainActivity.class);
                                startActivity(main);

                            }

                        } catch (Exception e) {
                            Log.v("LogLogin", e.getMessage());
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.e("LogLogin", error.getMessage());
                    }
                }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("usuario_email", editEmail.getText().toString());
                params.put("usuario_senha", editSenha.getText().toString());
                return params;
            }

        };
        requestQueue.add(stringRequest);

    }

    public static class MainActivity extends AppCompatActivity {

        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_main);
        }
    }
}

