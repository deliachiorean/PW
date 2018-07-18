package model;

public class Comment {
    private int id;
    private int postId;
    private String email;
    private String comment;
    private int accepted;

    public Comment(int postId, String email, String comment, int accepted) {
        this.id = 0;
        this.postId = postId;
        this.email = email;
        this.comment = comment;
        this.accepted = accepted;
    }

    public Comment(int id, int postId, String email, String comment, int accepted) {
        this.id = id;
        this.postId = postId;
        this.email = email;
        this.comment = comment;
        this.accepted = accepted;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getPostId() {
        return postId;
    }

    public void setPostId(int postId) {
        this.postId = postId;
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

    public int getAccepted() {
        return accepted;
    }

    public void setAccepted(int accepted) {
        this.accepted = accepted;
    }
}
