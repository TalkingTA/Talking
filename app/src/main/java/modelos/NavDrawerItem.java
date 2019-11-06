package modelos;


public class NavDrawerItem {
    private boolean notificacao;
    private String titulo;


    public NavDrawerItem() {

    }

    public NavDrawerItem(boolean notificacao, String titulo) {
        this.notificacao = notificacao;
        this.titulo = titulo;
    }

    public boolean isShowNotify() {
        return notificacao;
    }

    public void setShowNotify(boolean notificacao) {
        this.notificacao = notificacao;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }
}
