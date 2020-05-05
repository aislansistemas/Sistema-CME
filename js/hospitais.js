function desativaHospital(id){
		let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="border-radius:20px;background: rgba(150,150,150,0.2);padding:2%;margin-top:100px;"

			let h5=document.createElement('h5')
			h5.innerHTML="Deseja realmente inativar esse Hospital?"
			h5.className="text-dark pl-2"

			let form=document.createElement('form')
			form.action="Controllers/HospitalController.php?acao=desativar"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:50%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id
			
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-2 mr-2 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='admin.php'
			link.className='mt-2 mr-2 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
	}

function ativaHospital(id){
	let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="border-radius:20px;background: rgba(150,150,150,0.2);padding:2%;margin-top:100px;"

			let h5=document.createElement('h5')
			h5.innerHTML="Deseja realmente ativar esse Hospital?"
			h5.className="text-dark pl-2"

			let form=document.createElement('form')
			form.action="Controllers/HospitalController.php?acao=ativar"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:50%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id
			
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-2 mr-2 btn btn-success'
			button.innerHTML='CONFIRMAR'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='admin.php'
			link.className='mt-2 mr-2 btn btn-danger'
			link.innerHTML='VOLTAR'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}	