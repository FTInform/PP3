
class Carta {
    constructor(emoji) {
        this.emoji = emoji;
        this.boton = document.createElement('button');
        this.boton.textContent = '?';
    }
}


class Juego {
    constructor() {
        this.enTurno = [];
        this.pares = 0;
        this.bloqueado = false;
        this.cartas = [];
        this.totalPares = 50;
    }

    obtenerEmojis() {
        return  [

            '😀','🐶','🍎','🚗','⚽','🎸','📚','🌈','🔥','💎',
            '🦋','🍕','🚀','🎧','🏀','🌵','🐱','🍩','✈️','🎮',
            '🧠','🌙','🐼','🍔','🚲','🎬','🏆','🌊','🦄','🥑',
            '📷','🎲','🐸','🍉','🚢','🎯','🌸','🐢','🍪','🏹',
            '🧩','🌍','🐘','🍇','🚁','🎤','🌟','🐙','🍓','⚡'
            
        ];
    }


    mezclarEmojis(array) {
        return [...array, ...array].sort(() => Math.random() - 0.5);
    }

    previsualizacion() {
        const previewDiv = document.getElementById('preview');
        previewDiv.textContent = 'Visualizando cartas... 2 segundos';

       
        this.cartas.forEach(carta => {
            carta.boton.textContent = carta.emoji;
            carta.boton.disabled = true;
        });


        setTimeout(() => {
            this.cartas.forEach(carta => {
                carta.boton.textContent = '?';
                carta.boton.disabled = false;
            });
            previewDiv.textContent = '';
        }, 2000);
    }

    crearCartas(emojis) {
        const tablero = document.getElementById('tablero');
        
        emojis.forEach(emoji => {
            let carta = new Carta(emoji);
            this.cartas.push(carta);

            carta.boton.addEventListener('click', () => this.alHacerClick(carta));
            tablero.appendChild(carta.boton);
        });
    }

    alHacerClick(carta) {
        
        if (this.bloqueado || carta.boton.textContent !== '?') return;

        
        carta.boton.textContent = carta.emoji;
        this.enTurno.push(carta);

        if (this.enTurno.length === 2) {
            this.verificarPareja();
        }
    }

 
    verificarPareja() {
        this.bloqueado = true;
        const [c1, c2] = this.enTurno;

        if (c1.emoji === c2.emoji) {
         
            this.pares++;
            this.enTurno = [];
            this.bloqueado = false;

      
            if (this.pares === this.totalPares) {
                document.getElementById('mensaje').textContent = '🎉 ¡Ganaste! 🎉';
            }
        } else {
        
            setTimeout(() => {
                c1.boton.textContent = '?';
                c2.boton.textContent = '?';
                this.enTurno = [];
                this.bloqueado = false;
            }, 1000);
        }
    }

  
    iniciar() {
        const emojiBase = this.obtenerEmojis();
        const emojis = this.mezclarEmojis(emojiBase);
        
        this.crearCartas(emojis);
        this.previsualizacion();
    }
}


window.addEventListener('load', () => {
    new Juego().iniciar();
});

