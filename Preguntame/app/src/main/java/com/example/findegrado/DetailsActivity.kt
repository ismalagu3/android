package com.example.findegrado

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.example.findegrado.databinding.ActivityDetailsBinding

class DetailsActivity : AppCompatActivity() {

    private lateinit var binding: ActivityDetailsBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityDetailsBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        val pregunta = intent.getStringExtra("pregunta")
        val boton = intent.getStringExtra("boton")
        val nombre = intent.getStringExtra("nombre")

        binding.pregunta.text = "Pregunta: $pregunta"
        binding.boton.text = "Botón: $boton"
        binding.nombre.text = "Nombre: $nombre"

        binding.volver.setOnClickListener{
            val intent = Intent(this@DetailsActivity, MainActivity::class.java)
            intent.putExtra("nombre","$nombre")
            this@DetailsActivity.startActivity(intent)
        }
    }
}