package com.example.findegrado

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.example.findegrado.databinding.ActivityMainBinding
import kotlinx.coroutines.*
import org.json.JSONObject
import java.io.*
import java.net.HttpURLConnection
import java.net.URL

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        binding.enviar.setOnClickListener {
            postMethod()
        }
    }

    private fun postMethod() {
        if (binding.verde.isChecked){
            val boton = "verde"
            JSON(boton)
        }
        else if (binding.amarillo.isChecked){
            val boton = "amarillo"
            JSON(boton)
        }
        else if (binding.rojo.isChecked){
            val boton = "rojo"
            JSON(boton)
        }
        else{
            val boton = "verde"
            JSON(boton)
        }
    }

    private fun JSON(boton:String) {

        val pregunta = binding.pregunta.text
        val nombre = intent.getStringExtra("nombre")

        if (pregunta.isEmpty()){
            binding.required.text = "La pregunta no puede ir en blanco"
        }
        else{
            val jsonObject = JSONObject()
            jsonObject.put("pregunta", "$pregunta")
            jsonObject.put("boton", "$boton")
            jsonObject.put("nombre","$nombre")

            val jsonObjectString = jsonObject.toString()

            GlobalScope.launch(Dispatchers.IO) {
                val url = URL("http://192.168.1.115/android/APIs/pregunta.php")
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
                if (responseCode == HttpURLConnection.HTTP_OK) {
                    val response = httpURLConnection.inputStream.bufferedReader()
                        .use { it.readText() }
                    withContext(Dispatchers.Main) {
                        val intent = Intent(this@MainActivity, DetailsActivity::class.java)
                        intent.putExtra("pregunta", "$pregunta")
                        intent.putExtra("boton", "$boton")
                        intent.putExtra("nombre", "$nombre")
                        this@MainActivity.startActivity(intent)
                    }
                } else {
                    binding.required.text = "El servidor ha fallado"
                }
            }
        }
    }
}