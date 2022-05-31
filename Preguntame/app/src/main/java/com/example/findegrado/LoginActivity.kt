package com.example.findegrado

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.example.findegrado.databinding.ActivityLoginBinding
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.io.OutputStreamWriter
import java.net.HttpURLConnection
import java.net.URL

class LoginActivity : AppCompatActivity() {

    private lateinit var binding: ActivityLoginBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityLoginBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        binding.login.setOnClickListener{
            login()
        }
    }

    private fun login(){

        val nombre = binding.nombre.text
        val password = binding.password.text

        val jsonObject = JSONObject()
        jsonObject.put("nombre", "$nombre")
        jsonObject.put("password", "$password")

        val jsonObjectString = jsonObject.toString()

        GlobalScope.launch(Dispatchers.IO) {
            val url = URL("http://192.168.1.115/android/APIs/login.php")
            val httpURLConnection = url.openConnection() as HttpURLConnection
            httpURLConnection.requestMethod = "POST"
            httpURLConnection.setRequestProperty("Content-Type", "application/json")
            httpURLConnection.setRequestProperty("Accept", "application/json")
            httpURLConnection.doInput = true
            httpURLConnection.doOutput = true

            val outputStreamWriter = OutputStreamWriter(httpURLConnection.outputStream)
            outputStreamWriter.write(jsonObjectString)
            outputStreamWriter.flush()

            val responseCode = httpURLConnection.responseCode
            if (responseCode == HttpURLConnection.HTTP_OK){
                val response = httpURLConnection.inputStream.bufferedReader()
                    .use { it.readText() }
                if (response=="incorrecto"){
                        binding.error.text = "Nombre o contraseña incorrecto"
                }
                else if(response=="correcto"){
                    withContext(Dispatchers.Main) {
                        val intent = Intent(this@LoginActivity, MainActivity::class.java)
                        intent.putExtra("nombre","$nombre")
                        this@LoginActivity.startActivity(intent)
                    }
                }
            }
            else {
                binding.error.text = "Error de conexión"
            }
        }
    }
}