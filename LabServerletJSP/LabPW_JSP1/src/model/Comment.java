package model;

public class Comment {
    private String email;
    private String comment;
    private int authorized;


    public Comment(){ }

    public Comment(String email, String comment, int authorized) {
        this.email = email;
        this.comment = comment;
        this.authorized = authorized;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getComment() {
        return comment;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }

    public int getAuthorized() {
        return authorized;
    }

    public void setAuthorized(int authorized) {
        this.authorized = authorized;
    }

    @Override
    public String toString() {
        return "" +
                "Email:'" + email + '\'' +
                ", Comment:'" + comment + '\'' +
                ", Authorized:" + authorized;
    }
}
